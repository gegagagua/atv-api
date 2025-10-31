import api from "./axios"

export const SignIn = (email: string, password: string) => {
    return api.post('/login', {
        email,
        password
    }).then((res) => {
        return res.data
    })
}