import Image from "next/image";
import LinkButton from "@/components/LinkButton";
import EventSearchForm from "@/components/EventSearchForm";

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

type Props = {
    searchParams: Promise<{
        keyword?: string;
        date?: string;
    }>;
};

async function getEvents(keyword = "", date = ""): Promise<Schedule[]> {
    const params = new URLSearchParams();

    if (keyword) params.set("keyword", keyword);
    if (date) params.set("date", date);

    const url = `${process.env.NEXT_PUBLIC_API_BASE_URL}/event/list?${params.toString()}`;
    const res = await fetch(url, {
        cache: "no-store",
    });

    if (!res.ok) {
        throw new Error("イベント一覧の取得に失敗しました");
    }

    return res.json();
}

export default async function EventListPage({ searchParams }: Props) {
    const params = await searchParams;

    const keyword = params?.keyword ?? "";
    const date = params?.date ?? "";

    const currentEvents = await getEvents(keyword, date);

    return (
        <div className="m-10">
            <section className="mt-10">
                <EventSearchForm
                    keyword={keyword}
                    date={date}
                    action="/event/list"
                />
            </section>

            <section>
                <div className="flex justify-between mt-10 mb-4">
                    <h1 className="text-left text-2xl font-bold text-gray-500">
                        ≪イベント一覧≫
                    </h1>
                    <LinkButton
                        href="/past-event/list"
                        className="bg-blue-500 text-white text-sm"
                    >
                        過去のイベント
                    </LinkButton>
                </div>

                <table className="w-full border border-gray-300 border-collapse">
                    <thead>
                        <tr className="border border-gray-300 h-12 text-lg">
                            <th></th>
                            <th>開催日時</th>
                            <th>イベント名</th>
                            <th>講師</th>
                            <th>定員</th>
                            <th>金額</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {currentEvents.map((currentEvent) => (
                            <tr
                                key={currentEvent.id}
                                className="text-center h-12"
                            >
                                <td className="w-32 h-24">
                                    <div className="flex items-center justify-center w-full h-full">
                                        <Image
                                            src={`/event-images/${currentEvent.event.lesson_img1}`}
                                            alt="イベントイメージ"
                                            width={80}
                                            height={48}
                                            className="
                                            object-contain
                                            max-h-20
                                            w-auto
                                            hover:scale-125
                                            transition-transform
                                            duration-300
                                        "
                                        />
                                    </div>
                                </td>
                                <td>
                                    {new Date(
                                        currentEvent.start_at,
                                    ).toLocaleString("ja-JP")}
                                </td>
                                <td>{currentEvent.event.title}</td>
                                <td>{currentEvent.event.instructor_name}</td>
                                <td>{currentEvent.event.capacity}</td>
                                <td>
                                    ¥{currentEvent.event.price.toLocaleString()}
                                </td>
                                <td>
                                    <LinkButton
                                        href={`/event/${currentEvent.id}`}
                                        className="bg-blue-500 text-white"
                                    >
                                        詳細
                                    </LinkButton>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </section>
        </div>
    );
}
