import {
  Message,
} from 'element-ui';
import merge from 'element-ui/src/utils/merge';

export default function (options = {}) {
  const defaultOptions = {
    type: 'success',
    dangerouslyUseHTMLString: true,
    customClass: 'c-message',
    duration: 3000,
  };
  const opt = merge({}, defaultOptions, options);

  return Message(opt);
}
