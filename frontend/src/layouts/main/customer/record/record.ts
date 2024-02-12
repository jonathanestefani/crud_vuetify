import CustomerService from '@/app/Services/CustomerService';
import Swal from "sweetalert2";

export default {
  data() {
    return {
      valid: false,
      mode: 'new',
      customer: {
        codigo: '',
        empresa: '',
        sigla: '',
        razao_social: ''
      },
      enumOptions: ['PJ', 'PF'],
      selectedOption: null,
      rules: [
        value => !!value || 'Campo obrigatório.'
      ],
      loading: false
    };
  },
  methods: {
    async record() {
      this.$refs.form.validate().then(async (isValid) => {
        if (!isValid.valid) return;

        this.loading = true;
        
        try {
          await CustomerService.build().post("", this.customer);
          console.log('Dados salvos:', this.customer);

          new Swal({
            icon:"success",
            title: "Atenção",
            text: "Informações registrada com sucesso.",
          })

          this.resetForm();          
        } catch (error) {
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
    cancel() {
      this.resetForm();
      this.$router.push('/customer/list');
      
    },
    resetForm() {
      this.customer = {
        recnum: '',
        empresa: '',
        codigo: '',
        razao_social: '',
        cpf_cnpj: ''
      };
      this.selectedOption = '';
    }
  }
};