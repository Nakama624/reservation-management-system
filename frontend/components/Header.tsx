"use client";

import Image from "next/image";
import Link from "next/link";
import { useSession, signOut } from "next-auth/react";

export default function Header() {
    const { data: session, status } = useSession();

    return (
        <header
            className="
                w-full
                h-20
                bg-gray-100
                border-b
                border-gray-300
                flex
                items-center
                px-6
            "
        >
            <Link href="/reservation/list">
                <Image
                    src="/logo/logo.png"
                    alt="Logo"
                    width={192}
                    height={60}
                    className="w-48 h-auto"
                />
            </Link>

            <div>
                {status === "loading" ? (
                    <p>Loading...</p>
                ) : session ? (
                    <div className="flex items-center space-x-4">
                        <p>ようこそ, {session.user?.name}さん</p>
                        <button
                            onClick={() => signOut({ callbackUrl: "/login" })}
                            className="item-right font-medium text-black-600 rounded-md hover:bg-red-700"
                        >
                            ログアウト
                        </button>
                    </div>
                ) : (
                    <Link
                        href="/login"
                        className="px-4 py-2 font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                    >
                        ログイン
                    </Link>
                )}
            </div>
            <div className="ml-auto text-black text-right">
                <p className="text-2xl font-bold">TEL.0120-123-456</p>

                <p className="text-sm">【営業時間】9:00〜21:00</p>
            </div>
        </header>
    );
}
