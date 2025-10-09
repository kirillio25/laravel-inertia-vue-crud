<script setup>
import { ref } from "vue";
import draggable from "vuedraggable";

const items = ref([
    { id: 1, title: "Первый", description: "Описание первой задачи" },
    { id: 2, title: "Второй", description: "Описание второй задачи" },
    { id: 3, title: "Третий", description: "Описание третьей задачи" },
    { id: 1, title: "Первый", description: "Описание первой задачи" },
    { id: 2, title: "Второй", description: "Описание второй задачи" },
    { id: 3, title: "Третий", description: "Описание третьей задачи" },
]);

const dragging = ref(false);

const handleDragStart = () => {
    dragging.value = true;
};

const handleDragEnd = () => {
    dragging.value = false;
    document.querySelectorAll('.action-zone').forEach(el => el.classList.remove('drag-hover'));
};

const handleDragOver = (event) => {
    event.preventDefault(); // обязательно для dragover
    if (!dragging.value) return;

    document.querySelectorAll('.action-zone').forEach(el => el.classList.remove('drag-hover'));

    const zone = event.currentTarget;
    zone.classList.add('drag-hover');
};

const handleDragLeave = (event) => {
    event.currentTarget.classList.remove('drag-hover');
};
</script>

<template>
    <div class="action-panel mt-5">
        <div
            class="action-zone delete"
            @dragover="handleDragOver"
            @dragleave="handleDragLeave">
            Удалить
        </div>
        <div
            class="action-zone archive"
            @dragover="handleDragOver"
            @dragleave="handleDragLeave">
            Архив
        </div>
        <div
            class="action-zone done"
            @dragover="handleDragOver"
            @dragleave="handleDragLeave">
            Выполнено
        </div>
    </div>




    <div class="container mt-4">
        <h2 class="mb-4 fw-semibold text-center">To-Do карточки</h2>

        <div class="new-card-btn mb-4" @click="addCard">
            + Создать карточку
        </div>

        <draggable
            v-model="items"
            item-key="id"
            @start="handleDragStart"
            @end="handleDragEnd"
            class="cards-grid">
            <template #item="{ element }">
                <div class="card-item">
                    <h4 class="card-title">{{ element.title }}</h4>
                    <p class="card-desc">{{ element.description }}</p>
                </div>
            </template>
        </draggable>
    </div>
</template>


<style scoped>

/* Кнопка новой карточки */
.new-card-btn {
    padding: 15px;
    border-radius: 12px;

    text-align: center;
    font-weight: 600;
    color: #ea1414;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
    border: 2px dashed #da0d0d;
}

.new-card-btn:hover {
    transform: translateY(-3px);

    background: rgba(255, 255, 255, 0.15);
}


.cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.card-item {
    padding: 20px;
    border-radius: 12px;
    border: 4px dashed transparent;
    background-color: rgba(255, 255, 255, 0.05);
    min-height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    cursor: grab;
    user-select: none;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s, box-shadow 0.2s, border-image 0.3s;
    border-image: linear-gradient(90deg, #007bff, #00d4ff) 1;
}

.card-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}

.card-title {
    margin: 0 0 10px 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.card-desc {
    margin: 0;
    font-size: 0.95rem;
}

/* Панель действий */
.action-panel {
    display: flex;
    justify-content: space-around;
    border-radius: 16px;
    margin-bottom: 40px; /* отделение от карточек */
}

/* Зоны действий */
.action-zone {
    flex: 1;
    margin: 0 10px;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    font-weight: 600;
    color: #fff;
    cursor: default;
    transition: transform 0.2s, box-shadow 0.2s, border 0.3s, filter 0.3s, background 0.3s;
    border: 2px dashed #fff;
    background: linear-gradient(90deg, #ccc, #eee);
}

/* Цветовые градиенты */
.action-zone.delete { background: linear-gradient(90deg, #ff4b5c, #ff6b81); }
.action-zone.archive { background: linear-gradient(90deg, #ffa502, #ffcc00); }
.action-zone.done { background: linear-gradient(90deg, #1dd1a1, #10ac84); }

/* Hover мышью отключаем */
.action-zone:hover {
    transform: none;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

/* Эффект при наведении карточки (drag-hover) */
.action-zone.drag-hover {
    transform: scale(1.11);                  /* слегка увеличиваем */
    box-shadow: 0 10px 25px rgba(0,0,0,0.25); /* мягкая тень */
    border-color: #fff;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
    transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
}

/* Можно добавить лёгкий glow для Delete */
.action-zone.delete.drag-hover {
    background: linear-gradient(90deg, #ff6b81, #ff4b5c);
    box-shadow: 0 12px 28px rgba(255,75,92,0.4);
}

/* Аналогично для Archive */
.action-zone.archive.drag-hover {
    background: linear-gradient(90deg, #ffc107, #ffa502);
    box-shadow: 0 12px 28px rgba(255,193,7,0.4);
}

/* И для Done */
.action-zone.done.drag-hover {
    background: linear-gradient(90deg, #1dd1a1, #10ac84);
    box-shadow: 0 12px 28px rgba(29,209,161,0.4);
}



</style>
