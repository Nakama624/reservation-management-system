import EventReserveForm from "@/components/EventReserveForm";
import { getServerSession } from "next-auth";
import { authOptions } from "@/app/api/auth/[...nextauth]/route";
import { redirect } from "next/navigation";

export interface Schedule {
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

export interface EventReserveResponse {
    schedule: Schedule;
    paymentMethods: PaymentMethod[];
    remainingCapacity: number;
    errors?: {
        payment_method_id?: string;
        participants?: string;
    };
}

export interface PaymentMethod {
    id: number;
    payment_method: string;
}

interface Props {
    params: Promise<{ id: string }>;
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
        headers: {
            Accept: "application/json",
            Authorization: `Bearer ${session.accessToken}`,
        },
    });

    if (res.status === 401) {
        redirect("/login");
    }

    if (!res.ok) {
        throw new Error("予約入力欄が取得できませんでした");
    }

    return res.json();
}

export default async function EventReservePage({ params }: Props) {
    const { id } = await params;

    const { schedule, paymentMethods, remainingCapacity, errors } =
        await getEventReserve(id);

    return (
        <EventReserveForm
            schedule={schedule}
            paymentMethods={paymentMethods}
            remainingCapacity={remainingCapacity}
            errors={errors}
        />
    );
}
