<script setup>
import { ref } from "vue";
import draggable from "vuedraggable";








</script>

<template>

    <div class="action-panel mt-5">

    </div>

<!--    <div class="action-panel mt-5">-->
<!--        <div-->
<!--            class="action-zone delete"-->
<!--            @dragover="handleDragOver"-->
<!--            @dragleave="handleDragLeave">-->
<!--            Удалить-->
<!--        </div>-->
<!--        <div-->
<!--            class="action-zone archive"-->
<!--            @dragover="handleDragOver"-->
<!--            @dragleave="handleDragLeave">-->
<!--            Архив-->
<!--        </div>-->
<!--        <div-->
<!--            class="action-zone done"-->
<!--            @dragover="handleDragOver"-->
<!--            @dragleave="handleDragLeave">-->
<!--            Выполнено-->
<!--        </div>-->
<!--    </div>-->


</template>


<style scoped>


/* ----------------------------------------------------------------------------------------------------------- */
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
