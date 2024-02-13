import CustomerService from '@/app/Services/CustomerService';
import CompanyService from '@/app/Services/CompanyService';
import Swal from "sweetalert2";

export default {
  data() {
    return {
      valid: false,
      mode: 'new',
      customer: {
        recnum: null,
        codigo: null,
        empresa: null,
        razao_social: '',
        tipo: '',
        cpf_cnpj: ''
      },
      enumOptions: ['PJ', 'PF'],
      selectedOption: null,
      selectedOptionCompany: null,
      companyList: [],
      rules: [
        value => !!value || 'Campo obrigatório.'
      ],
      loading: false,
      loadingCompany: false,
    };
  },
  async created() {
    await this.loadCompanies();

    if (this.$route.params.id != undefined) {
      this.customer.recnum = this.$route.params.id;
      await this.load();
    }
  },
  methods: {
    formatData() {
      this.customer.empresa = parseFloat(this.selectedOptionCompany ? this.selectedOptionCompany.codigo : 0);
      this.customer.codigo = parseFloat(this.customer.codigo);
      this.customer.tipo = this.selectedOption;
    },
    async record() {
      this.$refs.form.validate().then(async (isValid) => {
        if (!isValid.valid) return;

        this.loading = true;
        
        try {
          this.formatData();

          if (!this.customer.recnum) {
            await CustomerService.build().post("", this.customer);
          } else {
            await CustomerService.build().put("/" + this.customer.recnum, this.customer);
          }

          new Swal({
            icon:"success",
            title: "Atenção",
            text: "Informações registrada com sucesso.",
          })

          this.resetForm();
          this.$router.push('/customer/list');
        } catch (error) {
          console.log(error, error.response.status, error.response);

          if (error.response.status == 422) {
            const data = JSON.parse(error.response.data);
            console.log(data);
            new Swal({
              icon:"error",
              title: "Atenção",
              text: data.message,
            })  
          } else
            new Swal({
              icon:"error",
              title: "Atenção",
              text: "Houve um problema ao tentar cadastrar",
            })

          console.error(error);
        } finally {
          this.loading = false;
        }
      })
    },
    async load() {
      this.loading = true;

      try {
        this.mode = 'edit';

        const response = await CustomerService.build().read(this.customer.recnum);

        this.customer = response;
        this.selectedOption = this.customer.tipo;
        this.selectedOptionCompany = this.companyList.filter((elem) => parseFloat(elem.codigo) == parseFloat(this.customer.empresa))[0];
      } catch (error) {         
        new Swal({
          icon:"error",
          title: "Atenção",
          text: "Houve um problema ao tentar carregar os dados!",
        })

        console.error(error);
      }

      this.loading = false;
    },
    async loadCompanies() {
      this.loadingCompany = true;

      const response = await CompanyService.build().search({all: true});

      console.log(response);

      this.companyList = response;

      this.loadingCompany = false;
    },
    cancel() {
      this.resetForm();
      this.$router.push('/customer/list');
      
    },
    resetForm() {
      this.customer = {
        recnum: null,
        empresa: null,
        codigo: null,
        tipo: '',
        razao_social: '',
        cpf_cnpj: ''
      };
      this.selectedOption = '';
    }
  }
};