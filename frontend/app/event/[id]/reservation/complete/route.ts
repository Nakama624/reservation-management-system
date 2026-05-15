import { redirect } from "next/navigation";
import { getServerSession } from "next-auth";
import { authOptions } from "@/app/api/auth/[...nextauth]/route";

interface Props {
    params: Promise<{
        id: string;
    }>;
}

export async function POST(request: Request, { params }: Props) {
    const session = await getServerSession(authOptions);

    if (!session?.accessToken) {
        redirect("/login");
    }
    const { id } = await params;

    const formData = await request.formData();

    const url = `${process.env.NEXT_PUBLIC_API_BASE_URL}/event/${id}/reservation/complete`;

    const res = await fetch(url, {
        method: "POST",
        headers: {
            Accept: "application/json",
            Authorization: `Bearer ${session.accessToken}`,
        },
        body: formData,
    });

    if (res.status === 401) {
        redirect("/login");
    }

    if (!res.ok) {
        throw new Error("予約の保存に失敗しました");
    }

    redirect(`/event/${id}/reservation/thanks`);
}
