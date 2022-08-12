export class DateTimeHelpers {
    static getDateTimeString() {
        let dateObject = new Date();
        let time = dateObject.toLocaleTimeString();
        let date = dateObject.toLocaleDateString();

        return '@ ' + time + ' on ' + date;
    }
}