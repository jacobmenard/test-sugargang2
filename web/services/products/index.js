/* #version=0.0.0-3#5 default 2023-05-10T21:45:22 16B38467B5FB0AA4 */
/* #version=0.0.0-3#4 default 2023-05-10T21:44:44 9CADE6C264A800B6 */
import api from '~/services/apis'

export default {

    async all(payload) {
        let url = `/api/v1/product-list`
        return await api.get(url, {params: payload})
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