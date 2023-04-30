<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { getToday } from '@/common';
import { onMounted, reactive, ref, computed   } from 'vue';
import { Inertia } from '@inertiajs/inertia'


const props = defineProps({
    'customers' : Array,
    'items' : Array,
})

onMounted(() => {
    form.date = getToday()
    props.items.forEach(item => {
        itemList.value.push({
            id: item.id,
            name: item.name,
            author: item.author,
            number_stock: item.number_stock,
            quantity: 0,
        })
    })

})

const form = reactive({
    date: null,
    customer_id: null,
    status: true,
    items: []
})

const totalQuantity = computed(() => {
    let total = 0
    itemList.value.forEach( item => {
        total += item.number_stock - (item.number_stock - item.quantity)
    })
    return total
})

const storeOrder = () => {
    itemList.value.forEach( item => {
        if(item.quantity > 0){
            form.items.push({
                id: item.id,
                quantity: item.quantity
            })
        }
    })

    Inertia.post(route('orders.store'), form)
}

const quantity = [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"] 

const itemList = ref([ ])
</script>

<template>
     <Head title="注文画面" />

     <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                注文画面
            </h2>
        </template>

<form @submit.prevent="storeOrder">
日付<br>
    <input type="date" name="date" v-model="form.date">
<br>
会員名<br> 
 <select name="customer" v-model="form.customer_id"> 
 <option v-for="customer in 
customers" :value="customer.id" :key="customer.id"> 
 {{ customer.id }} : {{ customer.name }} 
 </option> 
 </select>
 <br><br>

 商品・サービス<br> 
<table> 
 <thead>
    <tr>
        <th>Id</th>
        <th>商品名</th>
        <th>著者</th>
        <th>現在の在庫数</th>
        <th>数量</th>
        <th>残りの在庫数</th>
    </tr>
 </thead>
 <tbody> 
 <tr v-for="item in itemList" > 
 <td>{{ item.id }}</td> 
 <td>{{ item.name }}</td> 
 <td>{{ item.author }}</td> 
 <td>{{ item.number_stock }}</td> 
 <td> 
 <select name="quantity" v-model="item.quantity"> 
 <option v-for="q in quantity" :value="q">{{ q }}</option> 
 </select> 
 </td> 
 <td> 
 {{ item.number_stock - item.quantity }} 
 </td> 
 </tr> 
 </tbody> 
</table>

<br>

合計: {{ totalQuantity }} 冊<br>

<div class="p-2 w-full">
<button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
</div>
</form>
</AuthenticatedLayout>
</template>