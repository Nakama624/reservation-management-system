import { redirect } from "next/navigation";

interface Props {
    params: Promise<{
        id: string;
    }>;
}

export async function POST(request: Request, { params }: Props) {
    const { id } = await params;

    const formData = await request.formData();

    const url = `${process.env.NEXT_PUBLIC_API_BASE_URL}/event/${id}/reservation/complete`;

    const res = await fetch(url, {
        method: "POST",
        headers: {
            Accept: "application/json",
        },
        body: formData,
    });

    const body = await res.text();

    console.log("Laravel保存API URL:", url);
    console.log("Laravel保存API status:", res.status);
    console.log("Laravel保存API body:", body);

    if (!res.ok) {
        throw new Error("予約の保存に失敗しました");
    }

    redirect(`/event/${id}/reservation/thanks`);
}
