<template>
    <v-container>
        <v-data-table
            :headers="headers"
            :items="items"
            :items-per-page="5"
            class="elevation-1"
        ></v-data-table>
    </v-container>
</template>

<script setup>
import { ref } from 'vue'

const headers = [
    { text: 'Имя', value: 'name' },
    { text: 'Возраст', value: 'age' },
    { text: 'Город', value: 'city' },
]

const items = ref([
    { name: 'Алексей', age: 25, city: 'Москва' },
    { name: 'Мария', age: 30, city: 'Санкт-Петербург' },
    { name: 'Иван', age: 22, city: 'Казань' },
])
</script>
