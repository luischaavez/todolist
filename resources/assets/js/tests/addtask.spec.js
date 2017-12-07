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

    it('hides the text area by default', () => {
       notExists('.add-container');
    });

    it('shows text area if we click the link', () => {
       click('.show-container');

        exists('.add-container');
    });

    it('allows to add a new one', (done) => {
        click('.show-container');

        type('New task', '.task');

        click('button.add-task');

        moxios.stubRequest('/tasks/create', {
            status: 200,
            response: {
                task: 'New task',
                completed: false
            }
        });

        moxios.wait(() => {
            see('New task', 'ul');

            done();
        });
    });

    it('allow to add new task by type enter key', () => {
        wrapper.find('.show-container').trigger('click');

        var input = wrapper.find('.task');

        type('I can add a new task by press enter!', '.task');

        input.trigger('keydown.enter');

        moxios.stubRequest('/tasks/create', {
            status: 200,
            response: {
                task: "New task",
                completed: false
            }
        });

        moxios.wait(() => {
            see('I can add a new task by press enter!', 'ul');

            done();
        });
    });

    it('cleans the input after add new one', () => {
        click('.show-container');

        type('New task', '.task');

        click('button.add-task');

        expect(wrapper.find('.task').element.value).toBe("");
    });

    let see = (text, selector) => {
        let wrap = selector ? wrapper.find(selector) : wrapper;

        expect(wrap.text()).toContain(text);
    };

    let notExists = selector => {
      expect(wrapper.contains(selector)).toBe(false);
    };

    let exists = selector => {
      expect(wrapper.contains(selector)).toBe(true);
    };

    let click = selector => {
      wrapper.find(selector).trigger('click');
    };

    let type = (text, selector) => {
        let node = wrapper.find(selector);

        node.element.value = text;
        node.trigger('input');

        return node;
    }
});