<template>
  <v-list :lines="false" bg-color="transparent" density="compact">
    <v-list-item class="itemList" v-for="(item, key) in items" :key="key">
      <strong v-if="key == 0" class="title">{{ item.name }}</strong>
      <router-link :to="item.url">
        <span v-if="key > 0">{{ item.name }}</span>
      </router-link>
    </v-list-item>
  </v-list>
</template>

<script lang="ts">
interface Item {
  name: String;
  url: String;
}

export default {
  name: "List",
  props: {
    data: Array<Item>,
  },
  data() {
    return {
      items: this.data || [],
    };
  },
};
</script>

<style lang="scss">
.title {
  font-size: 14px;
}
.v-list-item--density-compact {
  min-height: 24px !important;
  color: white;
}
.v-list-item--density-compact * {
  color: white;
  text-decoration: none;
}
</style>
