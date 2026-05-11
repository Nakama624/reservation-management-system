// "use client";

// export default function LogoutButton() {
//     const logout = async () => {
//         await fetch("http://localhost/sanctum/csrf-cookie", {
//             credentials: "include",
//         });

//         const res = await fetch("http://localhost/logout", {
//             method: "POST",
//             credentials: "include",
//             headers: {
//                 Accept: "application/json",
//             },
//         });

//         if (res.ok) {
//             window.location.href = "/login";
//         }
//     };

//     return <button onClick={logout}>ログアウト</button>;
// }
