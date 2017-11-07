import axios from 'axios';
import moxios from 'moxios';
import Tasks from '../components/Tasks.vue';
import {mount} from 'vue-test-utils';
import expect from 'expect';

describe("AddTask", () => {
    var wrapper;

    beforeEach(() => {
        moxios.install();

        wrapper = mount(Tasks);
    });

    afterEach(() => {
        moxios.uninstall();
    });

    it('allows to add a new one', (done) => {
        var input = wrapper.find(".task");

        input.element.value = "New task";
        input.trigger("input");

        wrapper.find("button.add-task").trigger("click");

        moxios.stubRequest('/tasks/create', {
            status: 200,
            response: {
                task: "New task",
                completed: false
            }
        });

        moxios.wait(() => {
            expect(wrapper.find("ul").text()).toContain("New task");

            done();
        });
    });

    it("cleans the input after add new one", () => {
        var input = wrapper.find(".task");

        input.element.value = "New task";
        input.trigger("input");

        wrapper.find("button.add-task").trigger("click");

        expect(input.element.value).toBe("");
    });
});