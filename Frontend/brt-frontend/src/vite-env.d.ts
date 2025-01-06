/// <reference types="vite/client" />
export {};

declare global {
    interface Window {
        Pusher: unknown;
    }
}
