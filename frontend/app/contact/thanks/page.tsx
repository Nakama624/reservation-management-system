"use client";

import { useEffect } from "react";
import Link from "next/link";

export default function ContactCompletePage() {
    useEffect(() => {
        sessionStorage.removeItem("contact");
    }, []);

    return (
        <div className="w-[700px] mx-auto mt-20 text-center">
            <h1 className="text-3xl font-bold">
                お問合せありがとうございました
            </h1>

            <div className="mt-10">
                <Link href="/contact/list" className="text-blue-500 underline">
                    マイページへ
                </Link>
            </div>
        </div>
    );
}
