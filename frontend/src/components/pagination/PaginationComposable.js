import { reactive } from 'vue';

export default function PaginationComposable() {

  const pagination = reactive({
    page: 1,
    pageStart: 0,
    pageStop: 0,
    itemsPerPage: 5,
    pageCount: 0,
    itemsLength: 0
  });

  const default_pagination = reactive({
    itemsPerPage: 5
  });

  function paginate(response) {
    const toPagination = { ...response };

    delete toPagination.data;

    pagination.itemsLength = toPagination.total;
    pagination.pageCount = toPagination.last_page;
    pagination.pageStart = toPagination.from;
    pagination.pageStop = toPagination.to;
  }

  return {
    pagination,
    default_pagination,
    paginate
  }
};
