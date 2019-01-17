import {
  MessageBox,
} from 'element-ui';

import translate from './translate';

const open = (msg = '', options = {}) => {
  const defaultOpt = {
    center: true,
    dangerouslyUseHTMLString: true,
    showConfirmButton: false,
    showCancelButton: true,
    cancelButtonText: translate('common_close'),
    confirmButtonText: translate('common_ok'),
    callback: () => {},
  };
  MessageBox.setDefaults(defaultOpt);
  return MessageBox.alert(msg, options);
};

export default function (msg = '', options = {}) {
  return open(msg, options);
}
