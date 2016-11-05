/**
 * A helper class to connect to the Home Assistant API.
 * @param ha_url
 * @param update_callback
 * @constructor
 */
function HomeAssistantApi(ha_url, update_callback) {

    /** @var array entities The internal representation of the entities */
    this.entities = [];

    /** @var string ha_url The url to Home Assistant */
    this.ha_url = ha_url;

    /** @var callback update_callback The function that will be called to update an entity */
    this.update_callback = update_callback;

    /**
     * Get the data at the specified URL
     */
    this.getEntities = function () {

        // Clear current entities
        this.entities = [];

        // Setup new AJAX call
        var xhr = new XMLHttpRequest();
        xhr.open('GET', this.ha_url + '/api/states');
        xhr.onload = function (e) {
            var data = JSON.parse(this.response);
            for (var i = 0; i < data.length; i++) {
                HomeAssistantApi.processEntity(data[i]);
            }
        };
        xhr.send();
    };

    /**
     * Process a single entity and update the UI.
     * @param entity
     */
    this.processEntity = function (entity) {

        // Store entity in memory
        this.entities[entity.entity_id] = entity;

        // Execute callback
        this.update_callback(entity);
    };

    /**
     * Setup the Event Stream Listener to update the UI in real-time.
     */
    this.setEventStreamListener = function () {
        if (!!window.EventSource) {

            var source = new EventSource(this.ha_url + '/api/stream?restrict=state_changed,component_loaded,service_registered');
            source.addEventListener('message', function (e) {

                // Skip ping messages
                if (e.data == 'ping') {
                    return;
                }

                // Parse event
                var data = JSON.parse(e.data);

                // Process entity
                if (data.event_type == 'state_changed') {
                    var entity = {};
                    entity.entity_id = data.data.entity_id;
                    entity.state = data.data.new_state.state;
                    HomeAssistantApi.processEntity(entity);
                }
            }, false);

            source.addEventListener('open', function (e) {
                // Connection was opened.
            }, false);

            source.addEventListener('error', function (e) {
                if (e.readyState == EventSource.CLOSED) {
                    // Connection was closed.
                    // TODO: I think we should re-open.
                }
            }, false);

        } else {
            alert('This browser is not compatible since EventSource is not supported.');
        }
    };

}