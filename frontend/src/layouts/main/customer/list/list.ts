import CustomerService from '@/app/Services/CustomerService';
import Pagination from "@/components/pagination/Pagination.vue";
import PaginationComposable from "@/components/pagination/PaginationComposable.js";
import Swal from "sweetalert2";

export default {
  setup() {
    const { pagination, default_pagination, paginate} = PaginationComposable();

    return {
      pagination,
      default_pagination,
      paginate
    }
  },

  components: {
    Pagination
  },
  data() {
    return {
      loading: false,
      headers: [
        { title: 'Recnum', value: 'recnum' },
        { title: 'Empresa', value: 'empresa' },
        { title: 'Código', value: 'codigo' },
        { title: 'Razão Social', value: 'razao_social' },
        { title: 'Tipo', value: 'tipo' },
        { title: 'CPF/CNPJ', value: 'cpf_cnpj' },
        { title: '#', value: 'opcao', align: 'center' },
      ],
      items: [],
      paginationObject: {},
    };
  },
  created() {
    this.paginationObject = this.pagination;
  },
  methods: {
    record() {
      this.$router.push('/customer/record');
    },
    edit(item) {
      this.$router.push('/customer/record/' + item.recnum);
    },
    destroy(item) {
      new Swal({
        icon:"warning",
        title: "Atenção",
        text: "Deseja mesmo excluir?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim",
        cancelButtonText: "Não"
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            await CustomerService.build().delete(item.recnum);
            await this.load();
          } catch (error) {
            new Swal({
              icon:"error",
              title: "Atenção",
              text: "Houve um problema ao tentar excluir!",
            })
            console.error(error);
          }
        }
      });
    },
    async load() {
      this.loading = true;

      const query = this.getApiQuery();

      const response = await CustomerService.build().index({ query });

      this.paginate(response);

      this.items = response.data;

      this.loading = false;
    },
    getApiQuery() {
      return {
        params: {
          ...this.pagination,
          filter: { ...this.filter }
        }
      };
    },
  }
};