"use client";

import FullCalendar from "@fullcalendar/react";
import dayGridPlugin from "@fullcalendar/daygrid";
import { useRouter } from "next/navigation";
import type { EventClickArg, EventInput } from "@fullcalendar/core";

type Props = {
    schedules: EventInput[];
};

export default function SimpleCalendar({ schedules }: Props) {
    const router = useRouter();

    const handleEventClick = (info: EventClickArg) => {
        router.push(`/event/${info.event.id}`);
    };

    return (
        <FullCalendar
            plugins={[dayGridPlugin]}
            initialView="dayGridMonth"
            events={schedules}
            eventClick={handleEventClick}
            locale="ja"
            height="auto"
        />
    );
}
