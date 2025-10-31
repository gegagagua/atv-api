import api from "./axios"

export const getAtvs = (filter: string) => {
    return api.get(`/atvs${filter}`).then((res) => {
        return res.data
    })
}

export const getBrands = () => {
    return api.get(`/brands`).then((res) => {
        return res.data
    })
}

export const getCities = () => {
    return api.get(`/locations?georgian_only=true&international_only=false&active_only=true&country=Georgia&type=city&per_page=45`).then((res) => {
        return res.data
    })
}