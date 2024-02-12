import Api from "./Api";

/**
 * @typedef {Rest}
 */
export default class Rest extends Api {
  /**
   * @type {String}
   */
  static resource = "";

  /**
   * @type {String}
   */
  id = "id";

  /**
   * @param {String} resource
   * @param {Object} options
   * @param {Object} http
   */
  constructor(resource, options = {}, http = null) {
    super(Rest.normalize(Rest.base, resource), options, http);
  }

  /**
   * @return {this}
   */
  static build() {
    return new this(this.resource);
  }

  /**
   * PrepareRoute
   * funcao utilizada para definir a rota necessaria, sempre. até quando a relação for iniciada
   *
   * @param {String} end
   */
  prepareRoute(end) {
    const url = `${this.path}/${this.relationship}/${end}`;

    const routeToSend = `${url}`.replace(/([^:]\/)\/+/g, "$1");

    this.cleanRelationship();

    return routeToSend;
  }

  /**
   * CleanRelationship
   * essa funcao deve ser sempre chamada para nao persistencia de dados na classe http
   */
  cleanRelationship() {
    this.relationship = "";
  }

  /**
   * @param {Object} parameters
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  index({ query, url } = {}) {
    return this.http
      .get(this.prepareRoute(`/${url || ""}`), query)
      .then(this.constructor.then);
  }

  /**
   * @param {Object} record
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  create(record) {
    return this.post("", record);
  }

  /**
   * @param {Object} record
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  send(record) {
    return this.post("", record);
  }

  /**
   * @param {Object} record
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  sendResource(record, url = "", opt = {}) {
    return this.post(this.prepareRoute(`/${url || ""}`), record, opt);
  }

  /**
   * @param {String|Object} record
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  read(record) {
    return this.get(`/${this.getId(record)}`);
  }

  /**
   * @param {Object} record
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  update(record) {
    return this.patch(`/${this.getId(record)}`, record);
  }

  /**
   * @param {Object} record
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  destroy(record) {
    return this.delete(`/${this.getId(record)}`);
  }

  /**
   * @param {Object} parameters
   * @returns {*|PromiseLike<T | never>|Promise<T | never>}
   */
  search(params = {}) {
    const queryString = this.buildQuery(params);

    return this.get(`?${queryString}`).then((response) => response);
  }

  /**
   * @param {String|Object} record
   * @returns {String}
   */
  getId(record) {
    if (typeof record === "object") {
      return record[this.id];
    }
    return String(record);
  }

  buildQuery(obj, num_prefix, temp_key) {
    const output_string = [];

    obj = !obj ? {} : obj;

    Object.keys(obj).forEach((val) => {
      let key = val;

      if (num_prefix && !isNaN(key)) {
        key = num_prefix + key;
      }

      key = encodeURIComponent(key.replace(/[!'()*]/g, escape));

      if (temp_key) {
        key = temp_key + "[" + key + "]";
      }

      if (typeof obj[val] === "object") {
        const query = this.buildQuery(obj[val], null, key);

        if (query) {
          output_string.push(query);
        }
      } else {
        const value = encodeURIComponent(
          obj[val] + "".replace(/[!'()*]/g, escape)
        );

        if (key) {
          output_string.push(key + "=" + value);
        }
      }
    });

    return output_string.join("&");
  }

  queryString(obj = {}) {
    return Object.keys(obj)
      .map(function (key) {
        return key + "=" + obj[key];
      })
      .join("&");
  }
}
