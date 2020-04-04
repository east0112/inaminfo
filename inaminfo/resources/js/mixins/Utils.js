export default {
    created() {
    },
    data() {
        return {
            url:"/vue/load_api"
        }
    },
    methods: {
        getMoveFun() {
            const movefun = function(event){
                event.preventDefault();
            }
            return movefun;
        }
    }
 }