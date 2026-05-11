"use client";

import { useEffect, useState } from "react";

interface Contact {
    title: string;
    detail: string;
    img?: string;
}

export default function ContactConfirm() {
    const [contact, setContact] = useState<Contact | null>(null);

    useEffect(() => {
        const savedContact = sessionStorage.getItem("contact");

        if (savedContact) {
            setContact(JSON.parse(savedContact));
        }
    }, []);

    if (!contact) {
        return <div>お問い合わせ内容がありません</div>;
    }

    return (
        <div className="w-[500px] mx-auto mt-20">
            <h1 className="text-3xl mb-4 font-bold text-gray-500 text-center">
                お問合せ確認
            </h1>

            <form
                action="/contact/complete"
                method="post"
                className="border p-4"
            >
                <div className="flex items-start mb-4">
                    <p className="w-24 pt-2">件名</p>
                    <div className="w-4/5">
                        <div className="p-1 w-full">{contact.title}</div>
                    </div>

                    <input type="hidden" name="title" value={contact.title} />
                </div>

                <div className="flex items-start mb-4">
                    <p className="w-24 pt-2">詳細</p>
                    <div className="w-4/5">
                        <div className="p-1 w-full h-32">{contact.detail}</div>
                    </div>

                    <input type="hidden" name="detail" value={contact.detail} />
                </div>

                <div className="flex items-start mb-4">
                    <p className="w-24 pt-2">画像</p>
                    <div className="w-4/5">
                        {contact.img ? (
                            <>
                                <img
                                    src={`${process.env.NEXT_PUBLIC_STORAGE_URL}/${contact.img}`}
                                    className="w-40"
                                    alt="お問い合わせ画像"
                                />

                                <input
                                    type="hidden"
                                    name="img"
                                    value={contact.img}
                                />
                            </>
                        ) : (
                            <p>画像なし</p>
                        )}
                    </div>
                </div>

                <div className="flex justify-center">
                    <button
                        type="submit"
                        className="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        送信する
                    </button>
                </div>
            </form>
        </div>
    );
}
