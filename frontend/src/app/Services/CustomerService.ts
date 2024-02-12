import Rest from "../Base/Rest";

/**
 * @typedef {CustomerService}
 */
export default class CustomerService extends Rest {
  /**
   * @type {String}
   */
  static resource = "/customer";
}
