import api from '@/api/api';

export default {
  /**
   * 通过帐号密码创建认证口令
   *
   * @param  {[Object]} form [{email: String, password: String}]
   *
   * @return {[Promise]}
   */
  create (form) {
    return api.post('/token', form);
  },

  /**
   * 删除当前有效口令
   *
   * @return {[Promise]}
   */
  delete () {
    return api.delete('/token');
  }
}
