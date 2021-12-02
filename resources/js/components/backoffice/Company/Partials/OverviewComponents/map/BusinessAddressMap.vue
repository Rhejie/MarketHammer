<template>
    <div class="col-md-7">
        <GmapMap
            :center="{lat: addressCoordinates.lat ? addressCoordinates.lat : 0, lng: addressCoordinates.lng ? addressCoordinates.lng : 0}"
            :zoom="16"
            style="width: 100%; height: 320px">
                <GmapMarker
                    :position="{lat: addressCoordinates.lat ? addressCoordinates.lat : 0, lng: addressCoordinates.lng ? addressCoordinates.lng : 0}"
                    :clickable="true"
                    :draggable="false">
                </GmapMarker>
        </GmapMap>
    </div>
</template>
<script>

import _ from 'lodash';


export default {
    name: 'BusinessAddressMap',
    props: { 
        model: {},
    },
    data() {
        return {
            
        }
        
    },
    computed: {
        addressCoordinates(){
            let add = _.cloneDeep(this.model)
            return add
        },

    },
    methods: {
        
    }
}
</script>
