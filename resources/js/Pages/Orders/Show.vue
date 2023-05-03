<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link  } from '@inertiajs/vue3';
import { onMounted, reactive, ref, computed  } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import dayjs from 'dayjs';

const props = defineProps({
    'items' : Array,
    'log': Array,
})


onMounted(() => {
    console.log(props.items)
    console.log(props.log[0].customer_name)
})


</script>

<template>
    <Head title="注文履歴 詳細画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">注文履歴 詳細画面</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="storeOrder">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="date" class="leading-7 text-sm text-gray-600">注文日</label>
                                    <div  id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ dayjs(props.log[0].created_at).format('YYYY/MM/DD') }}
                                    </div>

                                </div>
                                </div>
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="customer" class="leading-7 text-sm text-gray-600">顧客名</label>
                                    <div  id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ props.log[0].customer_name }}
                                    </div>
                                </div>
                                </div>

                                <div class=" w-full mt-8 mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">著者</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入数</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">残りの在庫数</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in props.items" :key="item.id">
                                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.item_id  }}</td>
                                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.item_name  }}</td>
                                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.item_author  }}</td>
                                        <td class="border-b-2 border-green-200 px-4 py-3">{{ item.subtotal  }}</td>
                                        <td class="border-b-2 border-green-200 px-4 py-3">{{  item.last_stock }}</td>

                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="p-2 w-full">
                                <div class="">
                                    <label for="author" class="leading-7 text-sm text-gray-600">合計数量</label>
                                    <div   class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ props.log[0].total }}冊
                                    </div>
                                </div>
                                </div>

                                <div class="p-2 w-full">
                                <div class="">
                                    <label for="author" class="leading-7 text-sm text-gray-600">ステータス</label>
                                    <div  v-if="props.log[0].status == true" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        未キャンセル
                                    </div>
                                    <div  v-if="props.log[0].status == false" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        キャンセル済み
                                    </div>

                                </div>
                                </div>

                                <div class="p-2 w-full">
                                <div class="">
                                    <label for="author" class="leading-7 text-sm text-gray-600">キャンセル日</label>
                                    <div v-if="props.log[0].status == false"  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ dayjs(props.log[0].updated_at).format('YYYY/MM/DD') }}
                                    </div>
                                </div>
                                </div>

                                <div v-if="props.log[0].status == true" class="p-2 w-full">
                                    <Link as="button" :href="route('orders.edit',{order: props.log[0].id})" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">編集</Link>
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