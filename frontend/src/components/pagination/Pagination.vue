<template>
  <v-pagination
    v-if="!(pagination.pageCount <= 1)"
    class="my-4 max-width-80 mx-auto"
    v-model="pagination.page"
    @change="change"
    :length="pagination.pageCount"
    :total-visible="7"
    :disabled="loading"
    color="primary"
  />
</template>

<script lang="ts">
export default {
  name: "Pagination",
  props: {
    loading: Boolean,
    paginationObject: Object
  },
  mounted() {
    this.pagination = this.paginationObject;
  },
  data() {
    return {
      pagination: {
        pageCount: 0,
      }
    };
  },
  watch: {
    value() {
      this.pagination = this.value;
    },
    pagination: {
      deep: true,
      handler() {
        this.$emit("input", this.pagination);
      }
    },
    "pagination.page": {
      handler() {
        this.$emit("change", this.pagination.page);
      }
    }
  },
  methods: {
    change() {}
  }
};
</script>