/* #version=0.0.0-3#12 default 2023-05-11T01:40:56 28343DD5ADD576D3 */
/* #version=0.0.0-3#11 default 2023-05-11T01:37:07 494E9C87E8F6C103 */
import api from '~/services/apis'

export default {

    async all(payload) {
        let url = `/api/v1/product-list`
        return await api.get(url, {params: payload})
    },

    async perPage(payload) {
        let url = `${payload.url}${payload.search ? `&search=${payload.search}` : ''}`
        return await api.get(url)
    },

    async delete(productId) {
        let url = `api/v1/product-list/${productId}`
        return await api.delete(url)
    },

    async update(payload) {
        // let url = `api/v1/product-list/${payload.id}?title=${payload.title}&ingredients=${payload.ingredients}&sku=${payload.sku}&price=${payload.price}&quantity=${payload.quantity}`
        let url = `api/v1/product-list/${payload.id}`
        return await api.put(url, payload)
    },

    async add(payload) {
        // let url = `api/v1/product-list/${payload.id}?title=${payload.title}&ingredients=${payload.ingredients}&sku=${payload.sku}&price=${payload.price}&quantity=${payload.quantity}`
        let url = `api/v1/product-list`
        return await api.post(url, payload)
    }

}