import React, { useEffect, useState } from "react";
import echo from "../echo";

interface BRT {
    id: number;
    user_id: number;
    brt_code: string;
    reserved_amount: number;
    status: string;
    created_at: string;
    updated_at: string;
}

const BRTNotifications: React.FC = () => {
    const [notifications, setNotifications] = useState<BRT[]>([]);

    useEffect(() => {
        echo.channel("brts").listen("BRTUpdated", (event: { brt: BRT }) => {
            if (event.brt) {
                setNotifications((prev) => [...prev, event.brt]);
            }
        });

        return () => {
            echo.leaveChannel("brts");
        };
    }, []);

    return (
        <div>
            <h2>Real-Time Notifications</h2>
            <ul>
                {notifications.map((brt, index) => (
                    <li key={index}>
                        <strong>{brt.brt_code}</strong>: {brt.reserved_amount} coins -{" "}
                        {brt.status}
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default BRTNotifications;
