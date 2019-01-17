import {
  Loading,
} from 'element-ui';

/**
 *
 * @param object options
 */
export default function (options = {}) {
  const args = Object.assign({}, { spinner: 'icon-loading' }, options);
  return Loading.service(args);
}
