"use client";

import { useState } from "react";
import Link from "next/link";
import { useSession, signOut } from "next-auth/react";

export default function ToggleMenu() {
    const { data: session, status } = useSession();
    const [isOpen, setIsOpen] = useState(true);

    return (
        <div className="border-b">
            {/* ボタン */}
            <button
                onClick={() => setIsOpen(!isOpen)}
                className="w-full bg-gray-100 px-4 py-2 text-left hover:bg-gray-200"
            >
                {isOpen ? "▲ メニューを閉じる" : "▼ メニューを開く"}
            </button>

            {/* メニュー本体 */}
            {isOpen && (
                <div className="bg-white p-4 shadow">
                    <nav
                        className="
                        flex
                        items-center
                        gap-8
                        font-bold
                        ml-10
                    "
                    >
                        <Link
                            href="/event/list"
                            className="hover:text-blue-500 transition"
                        >
                            イベント一覧
                        </Link>
                        <Link
                            href="/calendar"
                            className="hover:text-blue-500 transition"
                        >
                            イベントカレンダー
                        </Link>

                        <div>
                            {status === "loading" ? (
                                <p>Loading...</p>
                            ) : session ? (
                                <div className="flex items-center space-x-4">
                                    <Link
                                        href="/reservation/list"
                                        className="hover:text-blue-500 transition"
                                    >
                                        予約一覧
                                    </Link>
                                    <Link
                                        href="/contact/list"
                                        className="hover:text-blue-500 transition"
                                    >
                                        お問合せ
                                    </Link>
                                </div>
                            ) : null}
                        </div>
                    </nav>
                </div>
            )}
        </div>
    );
}
