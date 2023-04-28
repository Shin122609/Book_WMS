<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
import FlashMessage from  '@/Components/FlashMessage.vue';

defineProps({
    items:Array
})
</script>

<template>
    <Head title="商品一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-8 mx-auto">
                <FlashMessage />
                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                    <Link as="button" :href="route('items.create')" class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">商品登録</Link>
                </div>
                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                    <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作品名</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">著者</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">出版社</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ISBN</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">在庫数</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">在庫状況</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td class="border-b-2 border-green-200 px-4 py-3">
                            <Link class="text-blue-400" :href="route('items.show',{item : item.id})">{{ item.id }}</Link>
                        </td>
                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.name }}</td>
                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.author }}</td>
                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.maker }}</td>
                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.isbn }}</td>
                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.number_stock }}</td>
                        <td class="border-b-2 border-green-200 px-4 py-3">
                        <span v-if="item.is_stocking === 1">販売中</span>
                        <span v-if="item.is_stocking === 0">停止中</span>
                    </td>
                    </tr>
                    </tbody>
                </table>
                </div>
              
            </div>
            </section>
            </div>
            </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>