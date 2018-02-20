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
   * 通过失效的口令向后端请求新的口令
   *
   * @return {[Promise]}
   */
  refresh () {
    return api.get('/token');
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
