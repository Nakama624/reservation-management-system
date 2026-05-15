import { getServerSession } from "next-auth";
import { authOptions } from "@/app/api/auth/[...nextauth]/route";
import { redirect } from "next/navigation";

interface Schedule {
    id: number;
    event_id: number;
    start_at: string;
    finish_at: string;
    event: {
        id: number;
        title: string;
        capacity: number;
        lesson_img1: string;
        lesson_img2: string;
        lesson_img3: string;
        catch_copy: string;
        instructor_name: string;
        instructor_img: string;
        instructor_profile: string;
        price: number;
    };
}

export interface PaymentMethod {
    id: number;
    payment_method: string;
}

interface EventReserveResponse {
    schedule: Schedule;
    paymentMethods: PaymentMethod[];
    remainingCapacity: number;
}

interface Props {
    params: Promise<{
        id: string;
    }>;
    searchParams: Promise<{
        participants?: string;
        payment_method_id?: string;
    }>;
}

async function getEventReserve(id: string): Promise<EventReserveResponse> {
    const session = await getServerSession(authOptions);

    if (!session?.accessToken) {
        redirect("/login");
    }

    const url = `${process.env.NEXT_PUBLIC_API_BASE_URL}/event/${id}/reservation`;

    const res = await fetch(url, {
        cache: "no-store",
        headers: {
            Accept: "application/json",
            Authorization: `Bearer ${session.accessToken}`,
        },
    });

    if (res.status === 401) {
        redirect("/login");
    }

    if (!res.ok) {
        throw new Error("予約情報が取得できませんでした");
    }

    return res.json();
}

export default async function EventReserveConfirmPage({
    params,
    searchParams,
}: Props) {
    const { id } = await params;
    const { participants, payment_method_id } = await searchParams;

    const { schedule, paymentMethods } = await getEventReserve(id);

    const reserveParticipants = Number(participants ?? 1);
    const paymentMethodId = Number(payment_method_id);

    const paymentMethod = paymentMethods.find(
        (method) => method.id === paymentMethodId,
    );

    if (!paymentMethod) {
        throw new Error("支払方法が見つかりませんでした");
    }

    const totalPrice = schedule.event.price * reserveParticipants;

    return (
        <div className="w-[700px] mx-auto mt-20">
            <h1 className="text-3xl font-bold text-center">ご予約確認</h1>

            <form
                action={`/event/${schedule.id}/reservation/complete`}
                method="post"
            >
                <table className="w-full my-12 border border-gray-300 border-collapse">
                    <tbody>
                        <tr className="text-xl h-16">
                            <th>イベント名</th>
                            <td>{schedule.event.title}</td>
                        </tr>

                        <tr className="text-xl h-16">
                            <th>開催日</th>
                            <td>
                                {new Date(schedule.start_at).toLocaleString(
                                    "ja-JP",
                                )}
                            </td>
                        </tr>

                        <tr className="text-xl h-16">
                            <th>講師名</th>
                            <td>{schedule.event.instructor_name}</td>
                        </tr>

                        <tr className="text-xl h-16">
                            <th>金額</th>
                            <td>¥{schedule.event.price.toLocaleString()}</td>
                        </tr>

                        <tr className="text-xl h-16">
                            <th>参加人数</th>
                            <td>
                                <input
                                    type="number"
                                    value={reserveParticipants}
                                    name="participants"
                                    readOnly
                                />
                            </td>
                        </tr>

                        <tr className="text-xl h-16">
                            <th>支払方法</th>
                            <td>
                                <input
                                    type="text"
                                    value={paymentMethod.payment_method}
                                    readOnly
                                />

                                <input
                                    type="hidden"
                                    name="payment_method_id"
                                    value={paymentMethod.id}
                                />
                            </td>
                        </tr>

                        <tr className="text-xl h-16">
                            <th>合計金額</th>
                            <td>¥{totalPrice.toLocaleString()}</td>
                        </tr>
                    </tbody>
                </table>

                <div className="flex justify-center">
                    <button
                        type="submit"
                        className="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        確定
                    </button>
                </div>
            </form>
        </div>
    );
}
