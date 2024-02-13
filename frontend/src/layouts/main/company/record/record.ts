import CompanyService from '@/app/Services/CompanyService';
import Swal from "sweetalert2";

export default {
  data() {
    return {
      valid: false,
      mode: 'new',
      company: {
        recnum: null,
        codigo: null,
        empresa: 0,
        sigla: '',
        razao_social: ''
      },
      rules: [
        value => !!value || 'Campo obrigatório.'
      ],
      loading: false
    };
  },
  created() {
    if (this.$route.params.id != undefined) {
      this.company.codigo = this.$route.params.id;
      this.load();
    }
  },
  methods: {
    formatData() {
      this.company.empresa = parseFloat(this.company.empresa);
      this.company.codigo = parseFloat(this.company.codigo);
    },
    async record() {
      this.$refs.form.validate().then(async (isValid) => {
        if (!isValid.valid) return;

        this.loading = true;
        
        try {
          this.formatData();

          if (!this.company.recnum) {
            await CompanyService.build().post("", this.company);
          } else {
            await CompanyService.build().put("/" + this.company.codigo, this.company);
          }

          new Swal({
            icon:"success",
            title: "Atenção",
            text: "Informações registrada com sucesso.",
          })

          this.resetForm();
          this.$router.push('/company/list');
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
    async load() {
      this.loading = true;

      try {
        this.mode = 'edit';

        const response = await CompanyService.build().read(this.company.codigo);

        this.company = response;
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
    cancel() {
      this.resetForm();
      this.$router.push('/company/list');
    },
    resetForm() {
      this.company = {
        recnum: '',
        codigo: '',
        empresa: '',
        sigla: '',
        razao_social: ''
      };
    }
  }
};