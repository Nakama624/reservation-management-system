import Image from "next/image";
import Link from "next/link";

export default function Header() {
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
                {/* <Link href="/past-events">過去のイベント一覧</Link> */}
                <Link
                    href="/reservation/list"
                    className="hover:text-blue-500 transition"
                >
                    予約一覧
                </Link>
                <Link
                    href="/reservation"
                    className="hover:text-blue-500 transition"
                >
                    新規予約
                </Link>
                <Link
                    href="/contact/list"
                    className="hover:text-blue-500 transition"
                >
                    お問合せ
                </Link>

                {/* <form method="POST" action="{{ route('logout') }}">
                    @csrf */}
                <button
                    type="submit"
                    className="hover:text-blue-500 transition"
                >
                    ログアウト
                </button>
                {/* </form> */}
            </nav>
            <div className="ml-auto text-black text-right">
                <p className="text-2xl font-bold">TEL.0120-123-456</p>

                <p className="text-sm">【営業時間】9:00〜21:00</p>
            </div>
        </header>
    );
}
