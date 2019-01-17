export default function (key, placeholderArray) {
  const language = window.webData.language;
  if (!window.translate_content || !window.translate_content[language][key]) {
    return key;
  }
  let value = window.translate_content[language][key];
  if (placeholderArray) {
    const ks = Object.keys(placeholderArray);
    ks.forEach((k) => {
      value = value.replace(`%${k}%`, placeholderArray[k]);
    });
  }
  return value;
}
