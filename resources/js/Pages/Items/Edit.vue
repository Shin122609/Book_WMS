<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    item: Object
})

const form = reactive({
    id: props.item.id,
    name: props.item.name,
    author: props.item.author,
    maker: props.item.maker,
    isbn: props.item.isbn,
    number_stock: props.item.number_stock,
    is_stocking: props.item.is_stocking,
})

const updateItem = id => {
    Inertia.put(route('items.update', { item: id}), form)
}
</script>

<template>
    <Head title="商品編集" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品編集</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                    <BreezeValidationErrors class="mb-4" />
                        <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="updateItem(form.id)">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
                                    <input type="text" id="name" name="name" v-model="form.name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="author" class="leading-7 text-sm text-gray-600">著者名</label>
                                    <input type="text" id="author" name="author" v-model="form.author" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="maker" class="leading-7 text-sm text-gray-600">出版社名</label>
                                    <input type="text" id="maker" name="maker" v-model="form.maker" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="isbn" class="leading-7 text-sm text-gray-600">ISBN</label>
                                    <input type="number" id="isbn" name="isbn" v-model="form.isbn" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="number_stock" class="leading-7 text-sm text-gray-600">在庫数</label>
                                    <input type="number" id="number_stock" name="number_stock" v-model="form.number_stock" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>  
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="is_stocking" class="leading-7 text-sm text-gray-600">在庫状況</label>
                                    <input type="radio" id="is_stocking" name="is_stocking" v-model="form.is_stocking" value="1" >
                                    <label class="ml-2 mr-4">在庫あり</label>
                                    <input type="radio" id="is_stocking" name="is_stocking" v-model="form.is_stocking" value="0" >
                                    <label class="ml-2 mr-4">在庫なし</label>
                                </div>
                                </div>                              
                                <div class="p-2 w-full">
                                  <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>