import "next-auth";

declare module "next-auth" {
    interface Session {
        accessToken: string;
        user: {
            id: string;
            name?: string | null;
            email?: string | null;
            image?: string | null;
            isManager: boolean;
        };
    }

    interface User {
        accessToken: string;
        isManager: boolean;
    }
}

declare module "next-auth/jwt" {
    interface JWT {
        accessToken: string;
        id: string;
        isManager: boolean;
    }
}
