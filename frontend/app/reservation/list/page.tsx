import LinkButton from "@/components/LinkButton";
import EventSearchForm from "@/components/EventSearchForm";

interface Reservation {
    id: number;
    schedule_id: number;
    participants: number;
    amount: number;
    payment_status: string;
    payment_methods_id: number;
    paid_at: number | null;
    is_canceled: boolean;
    schedule: {
        id: number;
        start_at: string;
        event: {
            title: string;
            instructor_name: string;
            capacity: number;
        };
    };
}

type Props = {
    searchParams: Promise<{
        keyword?: string;
        date?: string;
    }>;
};

async function getReservations(
    keyword = "",
    date = "",
): Promise<Reservation[]> {
    const params = new URLSearchParams();

    if (keyword) params.set("keyword", keyword);
    if (date) params.set("date", date);

    const url = `${process.env.NEXT_PUBLIC_API_BASE_URL}/reservation/list?${params.toString()}`;

    const res = await fetch(url, {
        cache: "no-store",
    });

    if (!res.ok) {
        throw new Error("予約一覧の取得に失敗しました");
    }

    return res.json();
}

export default async function Page({ searchParams }: Props) {
    const params = await searchParams;

    const keyword = params?.keyword ?? "";
    const date = params?.date ?? "";

    const reservations = await getReservations(keyword, date);

    return (
        <div className="m-10">
            <section className="mt-10">
                <EventSearchForm
                    keyword={keyword}
                    date={date}
                    action="/reservation/list"
                />
            </section>

            <section className="m-10 grid">
                <div className="flex justify-between items-center">
                    <h1 className="text-left text-2xl font-bold text-gray-500">
                        予約一覧
                    </h1>

                    <p className="text-red-400 text-right">
                        ※お支払後はキャンセルできません
                    </p>
                </div>

                <table className="w-full border border-gray-300 border-collapse">
                    <thead>
                        <tr className="border border-gray-300 h-12 text-lg">
                            <th>開催日時</th>
                            <th>イベント名</th>
                            <th>講師名</th>
                            <th>予約人数</th>
                            <th>支払ステータス</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        {reservations.map((reservation) => {
                            const startAt = new Date(
                                reservation.schedule.start_at,
                            );
                            const isPast = startAt < new Date();

                            return (
                                <tr
                                    key={reservation.id}
                                    className="text-center h-12"
                                >
                                    <td>{reservation.schedule.start_at}</td>

                                    <td>{reservation.schedule.event.title}</td>

                                    <td>
                                        {
                                            reservation.schedule.event
                                                .instructor_name
                                        }
                                    </td>

                                    <td>{reservation.participants}</td>

                                    <td>{reservation.payment_status}</td>

                                    <td>
                                        {isPast ? (
                                            <span className="text-gray-400">
                                                終了
                                            </span>
                                        ) : !reservation.is_canceled &&
                                          reservation.payment_status ===
                                              "未払い" ? (
                                            <form
                                                action={`/reservation/${reservation.id}/canceled`}
                                                method="post"
                                            >
                                                <button
                                                    type="submit"
                                                    className="bg-red-500 text-white px-4 py-2 rounded"
                                                >
                                                    キャンセル
                                                </button>
                                            </form>
                                        ) : reservation.is_canceled ? (
                                            <span className="text-gray-400">
                                                キャンセル済み
                                            </span>
                                        ) : (
                                            <span className="text-gray-400">
                                                キャンセル不可
                                            </span>
                                        )}
                                    </td>

                                    <td>
                                        <LinkButton
                                            href={`/reservation/${reservation.id}`}
                                            className="bg-blue-500 text-white"
                                        >
                                            詳細
                                        </LinkButton>
                                    </td>
                                </tr>
                            );
                        })}
                    </tbody>
                </table>
            </section>
        </div>
    );
}
