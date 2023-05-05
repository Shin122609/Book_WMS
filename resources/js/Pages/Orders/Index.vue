<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
import FlashMessage from  '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import { ref, onMounted } from 'vue' ;
import { Inertia } from '@inertiajs/inertia';
import dayjs from 'dayjs';

const props = defineProps({
    logs: Object
})

onMounted(() => {
    console.log(props.logs.data)
})

</script>

<template>
    <Head title="注文履歴" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">注文履歴</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-8 mx-auto">
                <FlashMessage />
                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                    <div>
                        <input type="text" name="search" placeholder="カナ文字で氏名を入力" v-model="search"> 
                        <button class="bg-blue-300 text-white py-2 px-2"  @click="searchCustomers">検索</button>
                    </div>
                </div>
                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                    <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計購入数</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="log in props.logs.data" :key="log.id">
                        <td class="border-b-2 border-gray-200 px-4 py-3">
                        <Link class="text-blue-400" :href="route('orders.show',{order: log.id})">
                            {{ log.id  }}
                        </Link>
                        </td>
                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ log.customer_name }}</td>
                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ log.total }}</td>
                        <td class="border-b-2 border-gray-200 px-4 py-3">
                            <span v-if="log.status === 1">注文済み</span>
                            <span class="text-red-400" v-if="log.status === 0">キャンセル</span>
                        </td>
                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ dayjs(log.created_at).format('YYYY-MM-DD HH:mm:ss') }}</td>

                    </tr>
                    </tbody>
                </table>
                </div>
              
            </div>
            <Pagination class="mt-6" :links="props.logs.links"></Pagination>
            </section>
            </div>
            </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>