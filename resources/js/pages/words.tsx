import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { MainLayout } from '@/layouts/main-layout';
import { type SharedData } from '@/types';
import { Textarea } from '@headlessui/react';
import { Form, Head, Link, router, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import * as ScrollArea from "@radix-ui/react-scroll-area"

type Word = {
    id: number;
    word: string;
};

type WordsProps = {
    words: Word[];
};


export default function Words({ words }: WordsProps) {
    return (
        <>
            <MainLayout title="Your words">
                <div className='flex justify-center'>
                    <div className='w-full'>
                        <h1 className='text-xl font-semibold mb-2'>Please add a list of words that will be used for exercises.</h1>
                        <Form method='post' action='/word'
                            resetOnSuccess={['words']}
                        >
                            {({
                                errors,
                                hasErrors,
                                processing,
                                progress,
                                wasSuccessful,
                                recentlySuccessful,
                            }) => (
                                <>
                                    <div className="grid gap-2">
                                        <Label htmlFor="email">Words (separate by spaces)</Label>
                                        <textarea
                                            id="words"
                                            name="words"
                                            required
                                            autoFocus
                                            rows={10}
                                            tabIndex={1}
                                            placeholder="안녕하세요 사장님"
                                            className='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-none'
                                        />
                                    </div>
                                    <Button type="submit" className='mt-2'>Submit</Button>
                                    <br />
                                    {recentlySuccessful && "Words submitted!"}
                                </>)}
                        </Form>
                    </div>
                    <div className='w-full ml-3'>
                        <ScrollArea.Root className="h-[300px] w-[300px] overflow-hidden rounded bg-black shadow-[0_2px_10px] shadow-black mt-10">
                            <ScrollArea.Viewport className="size-full rounded">
                                <div className="px-5 py-[15px]">
                                    <div className="text-[15px] font-medium leading-[18px] text-violet11">
                                        Words
                                    </div>
                                    {words.length > 0 && words.map((word: Word) => (
                                        <div
                                            className="mt-2.5 border-t border-t-mauve6 pt-2.5 text-[13px] leading-[18px] text-mauve12"
                                            key={word.word}
                                        >
                                            {word.word}
                                        </div>
                                    ))}
                                </div>
                            </ScrollArea.Viewport>
                            <ScrollArea.Scrollbar
                                className="flex touch-none select-none bg-gray-800 p-0.5 transition-colors duration-[160ms] ease-out hover:bg-gray-700 data-[orientation=horizontal]:h-2.5 data-[orientation=vertical]:w-2.5 data-[orientation=horizontal]:flex-col"
                                orientation="vertical"
                            >
                                <ScrollArea.Thumb className="relative flex-1 rounded-[10px] bg-violet-500 before:absolute before:left-1/2 before:top-1/2 before:size-full before:min-h-11 before:min-w-11 before:-translate-x-1/2 before:-translate-y-1/2" />
                            </ScrollArea.Scrollbar>
                            <ScrollArea.Scrollbar
                                className="flex touch-none select-none bg-blackA3 p-0.5 transition-colors duration-[160ms] ease-out hover:bg-blackA5 data-[orientation=horizontal]:h-2.5 data-[orientation=vertical]:w-2.5 data-[orientation=horizontal]:flex-col"
                                orientation="horizontal"
                            >
                                <ScrollArea.Thumb className="relative flex-1 rounded-[10px] bg-mauve10 before:absolute before:left-1/2 before:top-1/2 before:size-full before:min-h-[44px] before:min-w-[44px] before:-translate-x-1/2 before:-translate-y-1/2" />
                            </ScrollArea.Scrollbar>
                            <ScrollArea.Corner className="bg-blackA5" />
                        </ScrollArea.Root>
                    </div>
                </div>
            </MainLayout >
        </>
    );
}
