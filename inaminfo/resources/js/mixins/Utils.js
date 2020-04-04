export default {
    created() {
        this.movefun = function(event){
            event.preventDefault();
        }
    },
    data() {
        return {
            url:"/vue/load_api",
            movefun: ""
            
        }
    },
    methods: {
        getMoveFun() {
            return this.movefun;
        }
    }
 }