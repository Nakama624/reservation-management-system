"use client";

import { useState } from "react";
import LinkButton from "@/components/LinkButton";

import type {
    Schedule,
    PaymentMethod,
} from "@/app/event/[id]/reservation/page";

interface Props {
    schedule: Schedule;
    paymentMethods: PaymentMethod[];
    remainingCapacity: number;
    errors?: {
        payment_method_id?: string;
        participants?: string;
    };
}

export default function EventReserveForm({
    schedule,
    paymentMethods,
    remainingCapacity,
    errors,
}: Props) {
    const [participants, setParticipants] = useState(1);

    const totalPrice = schedule.event.price * participants;

    return (
        <div className="w-[700px] mx-auto mt-20">
            <h1 className="text-3xl font-bold text-center">ご予約</h1>

            <form
                action={`/event/${schedule.id}/reservation/confirm`}
                method="get"
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
                                    name="participants"
                                    min={1}
                                    max={remainingCapacity}
                                    value={participants}
                                    onChange={(e) =>
                                        setParticipants(Number(e.target.value))
                                    }
                                    className="border p-2 h-8 text-sm w-60"
                                />

                                <div className="text-sm text-red-500">
                                    {errors?.participants}
                                </div>

                                <div className="text-sm text-red-500">
                                    残り{remainingCapacity}人
                                </div>
                            </td>
                        </tr>

                        <tr className="text-xl h-16">
                            <th>支払方法</th>
                            <td>
                                <select
                                    name="payment_method_id"
                                    className="border p-2 h-10 text-sm w-60"
                                >
                                    <option value="">選択してください</option>

                                    {paymentMethods.map((paymentMethod) => (
                                        <option
                                            key={paymentMethod.id}
                                            value={paymentMethod.id}
                                        >
                                            {paymentMethod.payment_method}
                                        </option>
                                    ))}
                                </select>

                                <div className="text-sm text-red-500">
                                    {errors?.payment_method_id}
                                </div>
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
                        予約する
                    </button>
                </div>
                <div className="flex justify-center">
                    <LinkButton
                        href="/event/list"
                        className="bg-gray-300 px-4 py-2 rounded"
                    >
                        キャンセル
                    </LinkButton>
                </div>
            </form>
        </div>
    );
}
