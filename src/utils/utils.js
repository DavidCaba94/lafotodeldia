export default {
  transformDate(dateToFormat) {
    return dateToFormat.split('-')[2] + '/' + dateToFormat.split('-')[1] + '/' + dateToFormat.split('-')[0];
  }
}