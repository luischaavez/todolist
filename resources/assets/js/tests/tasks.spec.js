import axios from 'axios';
import moxios from 'moxios';
import { mount } from 'vue-test-utils';
import Tasks from '../components/Tasks.vue';
import expect from 'expect';

describe('Tasks', () => {
	var wrapper;

	beforeEach(() => {
        moxios.install();

		wrapper = mount(Tasks);
	});

	afterEach(() => {
		moxios.uninstall();
	});

	it('hides the list if there are not tasks', () => {
		notExists('ul');
	});

	it('fetch the list of tasks from the server', (done) => {

		moxios.stubRequest('/tasks', {
			status: 200,
			response: [
				{ task: 'Go to the store', completed: false},
				{ task: 'Finish screencast', completed: false},
			]
		});

		moxios.wait(() => {
            see('Go to the store', 'ul.list-reset');

            done();
		});

	});

	it('can complete any task', (done) => {
		wrapper.setData({
			tasks: [
				{ id: 1, task: 'Go to the store', completed: false},
                { id: 2, task: 'Finish test', completed: false}
			],
		});

		moxios.stubRequest('/tasks/1/complete', {
			status: 200,
			response: {

			}
		});

        click('ul > li:first-child .complete');

        moxios.wait(() => {
			expect(wrapper.find('ul.list-reset').text()).not.toContain('Go to the store');

			done();
		});
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
