import { redirect } from "next/navigation";

interface Props {
    params: Promise<{
        id: string;
    }>;
}

export async function POST(request: Request, { params }: Props) {
    const { id } = await params;

    const url = `${process.env.NEXT_PUBLIC_API_BASE_URL}/reservation/${id}/canceled`;

    const res = await fetch(url, {
        method: "PATCH",
        headers: {
            Accept: "application/json",
        },
    });

    const body = await res.text();

    console.log("cancel status:", res.status);
    console.log("cancel body:", body);

    if (!res.ok) {
        throw new Error("キャンセルに失敗しました");
    }

    redirect("/reservation/list");
}
