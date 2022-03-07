import { toRefs, reactive, watch} from 'vue';
import { Inertia } from "@inertiajs/inertia";

/**
 * @param props
 * @returns {ToRefs<UnwrapNestedRefs<{search: Function, field: *, direction: *}>>}
 */
export function getParams(props) {

    let params = reactive({
        search: props.filters.search,
        field: props.filters.field,
        direction: props.filters.direction,
    });

    return toRefs(params);
}

/**
 * @param params
 * @param route
 */
export function getWatch(params, route) {
    watch(() => params,
        _.throttle(() => {
            let search = {
                search: params.search.value,
                direction: params.direction.value,
                field: params.field.value,
                //todo optional
                year: params.year ? params.year.value : null,
                team: params.team ? params.team.value : null,
            };
            console.log(search)
            let query = _.pickBy(search);
            Inertia.get(route, query,{ replace: true, preserveState: true, preserveScroll: true });
        }, 200), {
            deep: true
        }
    )
}
