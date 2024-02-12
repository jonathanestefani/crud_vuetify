import CompanyService from '@/app/Services/CompanyService';
import Swal from "sweetalert2";

export default {
  data() {
    return {
      valid: false,
      mode: 'new',
      company: {
        codigo: '',
        empresa: '',
        sigla: '',
        razao_social: ''
      },
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
          await CompanyService.build().post("", this.company);
          console.log('Dados salvos:', this.company);

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
      this.$router.push('/company/list');
      
    },
    resetForm() {
      this.company = {
        codigo: '',
        empresa: '',
        sigla: '',
        razao_social: ''
      };
    }
  }
};