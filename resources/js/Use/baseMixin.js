import moment from 'moment';

export default {
    methods: {
        __(key, replace = {}) {

            // If locale is hu then replace hu.json key:value
            if (this.$page.props.locale == 'hu') {
                var translation = this.$page.props.language[key]
                    ? this.$page.props.language[key]
                    : key

                Object.keys(replace).forEach(function (key) {
                    translation = translation.replace(':' + key, replace[key])
                });

                return translation
            }

            // Key is the english
            return key;
        },
        isUrl(...urls) {
            return urls.filter(url => this.$page.url.match(url)).length ? true : false;
        },
        isAdmin() {
            return this.$page.props.roles.isAdmin
        },
        isTeamLeader() {
            return this.$page.props.roles.isTeamLeader
        },
        hasTeam() {
            return this.$page.props.user.team_id !== null
        },
        meetEvent(meet_event) {
            return '#' + meet_event.order + '. ' + meet_event.event.length + 'm ' + this.__(meet_event.event.sex) + ' ' + this.__(meet_event.event.swim) + ' ' + (meet_event.category ? meet_event.category : '')
        },
        timeFormat(time, format = 'YYYY.MM.DD HH:mm') {
            return moment(time).format(format)
        },
        route
    }
}